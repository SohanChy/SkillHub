import React from 'react';
import PropTypes from 'prop-types';
import '../../styles/homepage.scss';
import Header from './Header';
import Footer from './Footer';

class Base extends React.Component {
  render() {
    return (
      <div>
        <Header />
        {this.props.children}
        <Footer />
      </div>
    );
  }
}
Base.propTypes = {
  children: PropTypes.node.isRequired,
};

export default Base;
