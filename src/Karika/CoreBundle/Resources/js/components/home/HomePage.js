"use strict";

import React from 'react';
import rp from 'request-promise';
import { apiUrl } from '../../constants.js';
import FlatButton from 'material-ui/FlatButton';
import ClickMeComponent from './ClickMeComponent';

/**
 * Home Page
 */
var HomePage = React.createClass({
    componentDidMount: function() {
        console.log('HomePage.js');
    },
    handleClick: function() {
        rp({
            uri: apiUrl,
            json: true,
            qs: { action: 'hello' }
        })
        .then(function(response) {
            console.log(response);
        })
        .catch(function(error) {
            console.log(error);
        });
    },
    render: function() {
        return (
            <div>
                <h2>Home</h2>
                <FlatButton
                    label="API Call"
                    primary
                    onTouchTap={this.handleClick}
                />
                <div>
                    <ClickMeComponent/>
                </div>
            </div>
        );
    }
});

export default HomePage;