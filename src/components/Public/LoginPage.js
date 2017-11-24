import React from 'react';
import Base from './Base';
import axios from 'axios';

class LoginPage extends React.Component {

  constructor(props) {
    super(props);

    this.state = {
      email: '',
      password: ''
    };
  }


  componentDidMount() {
    axios.get(`https://jsonplaceholder.typicode.com`+'/posts/1')
      .then(res => {
        //const posts = res.data.data.children.map(obj => obj.data);
        //this.setState({ res });
        console.log(res);
      });
  }

  authUser = (e) => {
      e.preventDefault();

    console.log(this.state.email);
    console.log(this.state.password);

  }

  handleChange = (e) => {
    let newState = {};

    newState[e.target.name] = e.target.value;

    this.setState(newState);
  }

  render(){
  return (
      <div>
        <Base>
          <div className="wrapper">
            <h1>Login</h1>

            <form onSubmit={this.authUser}>
              <label>Email: </label><input type="name" name="email" onChange={this.handleChange} value={this.state.email}/><br/>
              <label>password: </label><input type="password" name="password" onChange={this.handleChange} value={this.state.password} /><br/>
              <button>Submit</button>
            </form>
          
          </div>
        </Base>
      </div>
  ); 
  }
}

export default LoginPage;
