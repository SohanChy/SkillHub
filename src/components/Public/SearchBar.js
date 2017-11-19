import React from 'react';
import { NavLink } from 'react-router-dom';

const SearchBar = () => {
  return (
    <div className="wrap">
       <div className="search">
          <input type="text" className="searchTerm" placeholder="What are you looking for?"/>
          <button type="submit" className="searchButton">
            <i className="fa fa-search"/>
         </button>
       </div>
    </div>
  );
};

export default SearchBar;