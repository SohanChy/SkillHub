import React from 'react';
import Base from './Base';
import Banner from './Banner';
import FeaturedSection from './FeaturedSection';
import FeatureCard from './FeatureCard';

const HomePage = () => {
  return (
      <Base>

                     
<FeaturedSection >

            <FeatureCard 
              type="large"
              bgImg="../res-static/images/card-bg-1.jpg"
              tagline="yo Bros"
              title="Wanna seee this tutorial?"
              description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus feugiat mi, a tincidunt lectus."
              />

            <FeatureCard 
              type="small"
              bgImg="../res-static/images/card-bg-1.jpg"
              tagline="yo Bros"
              title="Wanna seee this tutorial?"
              description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus feugiat mi, a tincidunt lectus."
              />

            <FeatureCard 
                type="small"
                bgImg="../res-static/images/card-bg-1.jpg"
                tagline="yo Bros"
                title="Wanna seee this tutorial?"
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus feugiat mi, a tincidunt lectus."
            />

          </ FeaturedSection>
            


          <Banner />

          <div className="top-spacing" />
          
          <FeaturedSection title="Hello world">

            <FeatureCard 
              type="large"
              bgImg="../res-static/images/card-bg-1.jpg"
              tagline="yo Bros"
              title="Wanna seee this tutorial?"
              description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus feugiat mi, a tincidunt lectus."
              />

            <FeatureCard 
              type="small"
              bgImg="../res-static/images/card-bg-1.jpg"
              tagline="yo Bros"
              title="Wanna seee this tutorial?"
              description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus feugiat mi, a tincidunt lectus."
              />

            <FeatureCard 
                type="small"
                bgImg="../res-static/images/card-bg-1.jpg"
                tagline="yo Bros"
                title="Wanna seee this tutorial?"
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus feugiat mi, a tincidunt lectus."
            />

          </ FeaturedSection>
          
      </Base>
  );
};

export default HomePage;
