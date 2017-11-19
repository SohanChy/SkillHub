import React from 'react';

const Teachers = () => {
  return (
    <section className="instagram-section"><a name="portfolio"/>
    <h3>Featured teachers</h3>
    <ul className="instagram-list"> 
      <li className="item">
        <a href="../res-static/images/instagram-1.jpg" data-featherlight="../res-static/images/instagram-1.jpg" className="photo-overlay">
          <img src="../res-static/images/instagram-1.jpg" alt="" className="profile" />
        </a>
      </li> 
      <li className="item">
        <a href="../res-static/images/instagram-2.jpg" data-featherlight="../res-static/images/instagram-2.jpg" className="photo-overlay">
          <img src="../res-static/images/instagram-2.jpg" alt="" className="profile" />
        </a>
      </li> 
      <li className="item">
        <a href="../res-static/images/instagram-3.jpg" data-featherlight="../res-static/images/instagram-3.jpg" className="photo-overlay">
          <img src="../res-static/images/instagram-3.jpeg" alt="" className="profile" />
        </a>
      </li> 
      <li className="item">
        <a href="../res-static/images/instagram-4.jpg" data-featherlight="../res-static/images/instagram-4.jpg" className="photo-overlay">
          <img src="../res-static/images/instagram-4.jpg" alt="" className="profile" />
        </a>
      </li> 
      
      <div className="clear"/> 
    </ul>
  </section>  
  );
};

export default Teachers;
