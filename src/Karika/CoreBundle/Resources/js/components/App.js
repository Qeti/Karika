"use strict";

import React from 'react';
import Header from './Header.js';
import {} from 'bootstrap/dist/css/bootstrap.css';
import {} from '../../css/app.css';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import darkBaseTheme from 'material-ui/styles/baseThemes/darkBaseTheme';

/**
 * Application component
 *
 * This is the parent component for all routes in the application. It displays
 * the header and wraps the content of the current route in a container div.
 */
var App = React.createClass({
	componentDidMount: function() {
		console.log('App.js');
	},
	render: function() {
		return (
            <MuiThemeProvider muiTheme={getMuiTheme(darkBaseTheme)}>
                <div>
                    <Header />
                    <div className="container">
                        <div className="row col-sm-12">
                            {this.props.children}
                        </div>
                    </div>
                </div>
            </MuiThemeProvider>
		);
	}
});

export default App;