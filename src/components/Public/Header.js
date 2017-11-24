import React from 'react';
import { NavLink } from 'react-router-dom';

const Header = () => {
  return (
    <header id="top">
      <div className="wrapper">
        <h1 className="logo"><a href="#">Skill<span>Hub</span></a></h1>
        <nav>
          <ul id="navigation">
            <li> <NavLink exact to="/">Home</NavLink> </li>
            <li> <NavLink to="/about">About</NavLink> </li>
            <li> <NavLink to="/browse">Browse courses</NavLink></li>
            <li> <NavLink to="/register">Register</NavLink></li>
            <li> <NavLink to="/login">Login</NavLink></li>
          </ul>
        </nav>
      </div>
    </header>
  );
};

export default Header;
