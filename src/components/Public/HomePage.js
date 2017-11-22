import React from 'react';
import Base from './Base';

import CourseCard from './CourseCard';


const HomePage = () => {
  return (
      <Base>

      <div id="content-wrapper" className="mui--text-center">
        <div className="mui--appbar-height" />
        <br />
        <br />
        <div className="mui--text-display3 row wow zoomInDown">Brand.io</div>
        <br />
        <br />
        <button className="mui-btn mui-btn--raised">Get started</button>
        <br />
        <br />
        <i className="fa fa-university fa-5x mui--color-pink-A100 mui--text-display3 row wow zoomIn" aria-hidden="true" />
      </div>

        <CourseCard 
        imgUrl="http://resources3.news.com.au/images/2014/01/13/1226800/983627-beach.gif"
        tag="SSC Physics"
        title="Full Course on SSC Physics With Basic"
        authorString="Taught By Shahed Zaman, BUET CSE"
        rating="4.5"
        tryLink="S"
        sylabusLink="X"
        />

      </Base>
  );
};

export default HomePage;
