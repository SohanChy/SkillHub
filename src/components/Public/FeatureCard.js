import React from 'react';
import PropTypes from 'prop-types';
import FeatureCardBase from './FeatureCardBase';

class FeatureCard extends React.Component {
  render() {
    return (
          <FeatureCardBase type={this.props.type} bgImg={this.props.bgImg}>
            <div className="article-card-content">
                <span className="category">{this.props.tagline}</span>
                <h4>{this.props.title}</h4>
                <p>{this.props.description}</p>
            </div>
          </FeatureCardBase>
    );
  }
}
FeatureCard.propTypes = {
    type: PropTypes.string.isRequired,
    bgImg: PropTypes.string.isRequired,
    tagline: PropTypes.string.isRequired,
    title: PropTypes.string.isRequired,
    description: PropTypes.string.isRequired,
};

export default FeatureCard;
