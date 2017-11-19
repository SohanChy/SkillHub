import React from 'react';
import PropTypes from 'prop-types';

class FeaturedSection extends React.Component {

	showTitle = function(title){
		if(title != undefined){
			return <h3>{title}</h3>;
		}
	}

  render() {
    return (
      <section className="featured-articles-section">	
				<div className="wrapper">
					{this.showTitle(this.props.title)}
						<div className="cards-container">
							{this.props.children}
							<br className="clear" />
						</div>
				</div>
			</section>
    );
  }
}
FeaturedSection.propTypes = {
	title: PropTypes.string.isRequired,
  children: PropTypes.node.isRequired,
};

export default FeaturedSection;
