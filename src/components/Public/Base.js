import React from 'react';
import PropTypes from 'prop-types';
// import Footer from './Footer';

import "../../styles/mui.css";
import "../../styles/styles.scss";
import Header from './Header';

class Base extends React.Component {
  s1 = {verticalAlign: 'middle'};
  s2 = {textAlign: 'right'};
  
  render() {
    return (
      <div>
        <Header />

      {this.props.children}
        
      <footer>
        <div className="mui-container mui--text-center mui--text-bottom">
          Made with ♥ by <a href="https://www.muicss.com">MUICSS</a>
        </div>
      </footer>

      </div>
    );
  }
}
Base.propTypes = {
  children: PropTypes.node.isRequired,
};

export default Base;
