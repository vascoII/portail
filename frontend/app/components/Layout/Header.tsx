import React from "react";
import Link from "next/link";
import UserMenu from "./UserMenu";
import LanguageSelector from "./LanguageSelector";
import SearchForm from "../Forms/SearchForm";

const Header: React.FC = () => {
  return (
    <header className="navbar navbar-static-top container-fluid">
      <div className="row">
        <div
          className="hidden-sm hidden-xs pull-left"
          style={{ width: "229px" }}
        >
          <Link href="/dashboard">
            <div className="logo"></div>
          </Link>
        </div>
        <div className="logo-container">
          <div className="row row-top">
            <div className="col-md-8 col-sm-9 no-padding pull-left">
              <div
                className="hidden-lg hidden-md pull-left"
                style={{ width: "130px" }}
              >
                <Link href="/dashboard">
                  <div className="logo-tablet"></div>
                </Link>
              </div>
              <h3 className="hidden-xs">Bienvenue dans votre espace client</h3>
            </div>
            <div className="col-md-4 col-sm-3 pull-right">
              <UserMenu />
              <LanguageSelector />
            </div>
          </div>
          <div className="row row-bot">
            <div className="hidden-lg hidden-md hidden-sm device-navbar">
              <button className="sidebar-collapse-icon btn btn-primary hidden-lg hidden-md">
                <img src="/images/toggle.png" alt="Toggle menu" />
              </button>
            </div>
            <div
              className="col-md-8 col-sm-8 hidden-xs"
              style={{ paddingLeft: 0 }}
            >
              <div
                className="visible-sm pull-left"
                style={{ textAlign: "center", width: "65px", padding: 0 }}
              >
                <button className="btn hidden-lg hidden-md hidden-xs sidebar-collapse-icon">
                  <i className="fa fa-bars" style={{ fontSize: "30px" }}></i>
                </button>
              </div>
              <SearchForm />
            </div>
            <div className="col-md-4 col-sm-4 hidden-xs">
              <SearchForm isCodeForm />
            </div>
          </div>
        </div>
      </div>
    </header>
  );
};

export default Header;
