import React from 'react';
import Base from './Base';
import Banner from './Banner';
import FeaturedSection from './FeaturedSection';
import FeatureCard from './FeatureCard';
import Courses from './Courses';
import Teachers from './Teachers';
import FullWidth from './FullWidth';


const HomePage = () => {
  return (
      <Base>


<FeaturedSection >

            <FeatureCard
              type="large"
              bgImg="../res-static/images/card-bg-1.jpg"
              tagline="Complete Courses"
              title="Learn any topic from our teachers, take a course!"
              description="Learn, participate and solve your problems."
              />

            <FeatureCard
              type="small"
              bgImg="../res-static/images/card-bg-1.jpg"
              tagline="Learn any topic"
              title="Wanna seee this tutorial?"
              description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus feugiat mi, a tincidunt lectus."
              />

            <FeatureCard
                type="small"
                bgImg="../res-static/images/card-bg-1.jpg"
                tagline="Learn any topic"
                title="Wanna seee this tutorial?"
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus feugiat mi, a tincidunt lectus."
            />

          </ FeaturedSection>

          <Banner />
          <Courses  />
          <FullWidth />


          <div className="top-spacing" />

          <FeaturedSection title="Hello world">

            <FeatureCard
              type="large"
              bgImg="../res-static/images/card-bg-1.jpg"
              tagline="Learn any topic"
              title="Wanna seee this tutorial?"
              description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus feugiat mi, a tincidunt lectus."
              />

            <FeatureCard
              type="small"
              bgImg="../res-static/images/card-bg-1.jpg"
              tagline="Learn any topic"
              title="Wanna seee this tutorial?"
              description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus feugiat mi, a tincidunt lectus."
              />

            <FeatureCard
                type="small"
                bgImg="../res-static/images/card-bg-1.jpg"
                tagline="Learn any topic"
                title="Wanna seee this tutorial?"
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus feugiat mi, a tincidunt lectus."
            />

          </ FeaturedSection>

          <Teachers/>
      </Base>
  );
};

export default HomePage;
