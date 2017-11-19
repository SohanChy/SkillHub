import React from 'react';
import PropTypes from 'prop-types';
import classnames from 'classnames';

class FeatureCardBase extends React.Component {
  bgImgStyle = {
    backgroundImage: 'url(' + this.props.bgImg + ')'
  };
  classNames = classnames('article-card', "card-" + this.props.type);

  render() {
    return (
        <div className={this.classNames} style={this.bgImgStyle}>
			<div className="article-card-content">
                {this.props.children}
			</div>
		</div>
    );
  }
}
FeatureCardBase.propTypes = {
    type: PropTypes.string.isRequired,
    bgImg: PropTypes.string.isRequired,
    children: PropTypes.node.isRequired,
};

export default FeatureCardBase;
