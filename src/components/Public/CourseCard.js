import React from 'react';
import PropTypes from 'prop-types';

const marginTop = {
    marginTop: '5px',
};

const marginLeft = {
    marginLeft: '10px',
};

const ratingStar = {
    fontSize: '17px',
    color:'gold'
};

  const CourseCard = (props) => {
  return (

    <div className="mui-container">
      <div className="card-base mui--z1">
        <img src={props.imgUrl} />
        <div className="label">
          <div className="mui--text-dark-secondary mui--text-caption">
            {props.tag}
          </div>
          <div className="title mui--text-title">
          {props.title} 
          </div>
          <div>
          {props.authorString}
          </div>
          
          <div style={marginTop} className="mui--divider-top mui--text-center">
          <a href={props.tryLink} className="mui-btn mui-btn--flat mui-btn--accent">Try this Course</a>
        <a href={props.sylabusLink} className="mui-btn mui-btn--flat mui-btn--primary">Sylabus</a>
        
        <span style={marginLeft}>{props.rating}</span><span className="mui--text-caption mui--text-dark-secondary ">/5</span><span style={ratingStar}>★</span>
        
          </div>
        
        </div>
     </div>
    </div>
    

  );
};

CourseCard.propTypes = {
    imgUrl: PropTypes.string.isRequired,
    tag: PropTypes.string.isRequired,
    title: PropTypes.string.isRequired,
    authorString: PropTypes.string.isRequired,
    rating: PropTypes.string.isRequired,
    tryLink: PropTypes.string.isRequired,
    sylabusLink: PropTypes.string.isRequired,
  };

export default CourseCard;

