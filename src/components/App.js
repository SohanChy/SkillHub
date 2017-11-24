/* eslint-disable import/no-named-as-default */
import React from 'react';
import PropTypes from 'prop-types';
import { Switch, Route } from 'react-router-dom';


//Import Public Pages
import HomePage from './Public/HomePage';
//import FuelSavingsPage from '../containers/FuelSavingsPage';
import AboutPage from './Public/AboutPage';
import NotFoundPage from './Public/NotFoundPage';
import LoginPage from './Public/LoginPage';
import RegisterPage from './Public/RegisterPage';
// This is a class-based component because the current
// version of hot reloading won't hot reload a stateless
// component at the top-level.

class App extends React.Component {
  render() {
    return (
        <Switch>
          {/* PUBLIC ROUTES */}
          <Route exact path="/" component={HomePage} />
          <Route path="/about" component={AboutPage} />
          <Route path="/login" component={LoginPage} />
          <Route path="/register" component={RegisterPage} />
          <Route component={NotFoundPage} />
        </Switch>
    );
  }
}

App.propTypes = {
  children: PropTypes.element
};

export default App;
