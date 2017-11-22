import React from 'react';
// import Footer from './Footer';

import Appbar from 'muicss/lib/react/appbar';

const Header = () => {
    return(
        <header>
        <Appbar>
            <div className="mui-container">
            <table>
                <tbody>
                <tr className="mui--appbar-height">
                <td className="mui--text-title">Brand.io</td>
                <td className="mui--text-right">
                    <ul className="mui-list--inline mui--text-body2">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#"><i className="fa fa-user" aria-hidden="true" /> Login</a></li>
                    </ul>
                </td>
                </tr>
                </tbody>
            </table>
            </div>
        </Appbar>
        </header>
    );
};


export default Header;