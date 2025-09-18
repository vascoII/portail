

    function PerformanceGauge(canvas, options) {
        var defaults = {
            value: 0.25,

            fillStyle: '#f1f1f1',
            strokeStyle: '#e4e4e6',
            fillGaugeStyle: '#8e98a2',
            fillGaugeWidth: 38,

            opening: 1.25,

            fillNeedleStyle: '#303030',

            needleHeight: 35,
            needleRadiusMax: 8,
            needleRadiusMin: 4,

            strokeWidth: 1
        };

        var _options = $.extend({}, defaults, options);

        if (_options.value < 0) {
            _options.value = 0;
        }

        if (_options.value > 1) {
            _options.value = 1;
        }

        _options.radius = 100;

        StatusGauge.apply(this, [ canvas, _options]);
    }
    PerformanceGauge.prototype = Object.create(StatusGauge.prototype);

    PerformanceGauge.prototype.draw = function (delta) {
        var canvas = this.canvas;
        var ctx = this.ctx;

        ctx.clearRect ( 0 , 0 , canvas.width , canvas.height );

        StatusGauge.prototype.draw.apply(this, [delta]);

        var w = canvas.width / 2;
        var h = canvas.height / 2;

        var radius = this.options.radius || Math.min(w, h) - 2;

        var ratio = this.options.value;

        if (this.options.animationEnable) {
            ratio *= this.animationProgress;
        }

        var opening = this.options.opening / 2;

        var radiusMax = radius;
        var min = (0.5 + opening) * Math.PI, max = (2.5 - opening) * Math.PI;
        var a = (ratio * (max - min)) + min;

        var bottomOpening = opening;
        if (bottomOpening > 0.5) {
            bottomOpening = 0.5;
        }
        var bottomPagging = radiusMax - (Math.cos(bottomOpening * Math.PI) * radiusMax);

        var x = w, y = h + (bottomPagging / 2);

        var needleRadiusMax = this.options.needleRadiusMax;
        var needleRadiusMin = this.options.needleRadiusMin;
        var needleHeight = this.options.needleHeight;

        ctx.save();
        ctx.fillStyle = this.options.fillNeedleStyle;

        ctx.translate(x, y);
        ctx.rotate(a - (0.5 * Math.PI));
        ctx.translate(-x, -y);

        (function () {
            ctx.beginPath();
            ctx.moveTo(x, y);
            ctx.lineTo(x + needleRadiusMax, y);
            ctx.lineTo(x, y + needleHeight);
            ctx.lineTo(x - needleRadiusMax, y);
            ctx.closePath();

            ctx.fill();
            ctx.beginPath();
            ctx.arc(x, y, needleRadiusMax, 0, 2 * Math.PI);
            ctx.closePath();
            ctx.fill();

            ctx.save();
            ctx.globalCompositeOperation = 'destination-out';
            ctx.beginPath();
            ctx.arc(x, y, needleRadiusMin, 0, 2 * Math.PI);
            ctx.closePath();
            ctx.fill();
            ctx.restore();
        })();

        ctx.restore();

    };

    function drawGauge(area) {

        $('.performance-gauge canvas').each(function () {
            var $this = $(this);
            var gaugeArea = $(this).parents('[data-area]').attr('data-area');

            if ($this.attr('data-loaded') == 'done') {
                return;
            }
            if ($this.attr('data-options') === undefined) {
                return;
            }

            console.log(area, gaugeArea);

            if (gaugeArea == area || area == null && gaugeArea === undefined) {
                var s = $this.attr('data-options');

                new PerformanceGauge(
                    this,
                    JSON.parse(s)
                );

                $(this).attr('data-loaded', 'done');
            }
        });
    }

    (function () {
        "use strict";

        drawGauge(null);
    })();