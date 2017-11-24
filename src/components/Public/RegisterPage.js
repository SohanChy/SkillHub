import React from 'react';
import Base from './Base';

class RegisterPage extends React.Component {
	constructor(props){
		super(props)

		this.state = {
			name: '',
			address: '',
			phone: '',
			email: '',
			password: '',
			confirmPass: ''
		}
	}


	handleChange = (e) => {
		let newState = {};
		newState[e.target.name] = e.target.value;
		this.setState(newState);
	}

	registerUser = (e) => {
		e.preventDefault();
	}
  
  	render(){
	  return (
	      <div>
	    	<Base>
	    		<div className="wrapper">
	    		<form onSubmit={this.registerUser}>
			        <h1>Regiter</h1>
			        <label>Name: </label><input type="name" name="name" onChange={this.handleChange}  value={this.state.name}/><br/>
			        <label>Address: </label><input type="name" name="address" onChange={this.handleChange} value={this.state.address} /><br/>
			        <label>Phone: </label><input type="name" name="phone" onChange={this.handleChange} value={this.state.phone}/><br/>
			        <label>Email: </label><input type="email" name="email" onChange={this.handleChange} value={this.state.email}/><br />
			        <label>Password: </label><input type="password" name="password" onChange={this.handleChange} value={this.state.password}/><br/>
			        <label>Confirm password: </label><input type="password" name="confirmPass" onChange={this.handleChange} value={this.state.confirm} /><br/>
			        <button type="submit">Submit</button>
		        </form>
		        </div>
	    	</Base>
	      </div>
	  );
  }
}

export default RegisterPage;
