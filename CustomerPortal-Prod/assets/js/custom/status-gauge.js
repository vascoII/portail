(function() {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame']
        || window[vendors[x]+'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
                timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());

var StatusGauge = (function () {
    "use strict";

    var __gauges = [];
    var __lastTime = null;
    function __updateGauge(time){
        var delta = time - __lastTime;

        if (__lastTime !== null) {
            var i = 0, l = __gauges.length;
            for (; i < l; i++) {
                var g = __gauges[i];

                g.draw(delta);
            }
        }
        __lastTime = time;
        requestAnimationFrame(__updateGauge);
    }
    requestAnimationFrame(__updateGauge);


    function StatusGauge(canvas, options) {
        if (!canvas) {
            return;
        }
        if (!canvas.getContext) {
            return;
        }

        this.animationProgress = 0;

        this.canvas = canvas;
        this.ctx = canvas.getContext('2d');

        var defaults = {
            value: 0.7,

            fillStyle: '#ffffff',
            strokeStyle: '#e4e4e6',
            fillGaugeStyle: '#ff6633',
            fillGaugeWidth: 10,

            opening: 0.6,

            strokeWidth: 1,
            animationEnable: true,
            animationDuration: 600
        };

        this.options = $.extend({}, defaults, options);

        if (this.options.value < 0) {
            this.options.value = 0;
        }

        if (this.options.value > 1) {
            this.options.value = 1;
        }

        if (this.options.animationEnable) {
            __gauges.push(this);
        }


        this.draw();
    }

    StatusGauge.prototype.draw = function (delta) {
        if (this.options.animationEnable && delta) {
            if (this.animationProgress < 1) {
                this.animationProgress += delta / this.options.animationDuration;
                if (this.animationProgress > 1) {
                    this.animationProgress = 1;
                }
            }
        }

        var ctx = this.ctx;
        var canvas = this.canvas;

        var w = canvas.width / 2;
        var h = canvas.height / 2;

        var radius = this.options.radius || w - 2;

        var ratio = this.options.value;

        var opening = this.options.opening / 2;

        if (this.options.animationEnable) {
             ratio *= this.animationProgress;
        }

        var radiusMax = radius, radiusMin = radius - this.options.fillGaugeWidth;
        var min = (0.5 + opening) * Math.PI, max = (2.5 - opening) * Math.PI;
        var a = (ratio * (max - min)) + min;

        var bottomOpening = opening;
        if (bottomOpening > 0.5) {
            bottomOpening = 0.5;
        }
        var bottomPagging = radiusMax - (Math.cos(bottomOpening * Math.PI) * radiusMax);

        var x = w, y = h + (bottomPagging / 2);

        ctx.beginPath();
        ctx.arc(x, y, radiusMax, min, max);
        ctx.arc(x, y, radiusMin, max, min, true);
        ctx.closePath();
        ctx.fillStyle = this.options.fillStyle;
        ctx.fill();

        ctx.beginPath();
        ctx.arc(x, y, radiusMax, min, a);
        ctx.arc(x, y, radiusMin, a, min, true);
        ctx.closePath();
        ctx.fillStyle = this.options.fillGaugeStyle;
        ctx.fill();

        ctx.beginPath();
        ctx.arc(x, y, radiusMax, min, max);
        ctx.arc(x, y, radiusMin, max, min, true);
        ctx.closePath();
        ctx.lineWidth = this.options.strokeWidth;
        ctx.strokeStyle = this.options.strokeStyle;
        ctx.stroke();


    };

    $('.status-gauge canvas').each(function () {
        var $this = $(this);
        var s = $this.attr('data-options');

        new StatusGauge(
            this,
            JSON.parse(s)
        );
    });

    return StatusGauge;
})();

