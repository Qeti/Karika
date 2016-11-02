import React from 'react';
import RaisedButton from 'material-ui/RaisedButton';

export default class ClickMeComponent extends React.Component {
    
    constructor(props) {
        super(props);
    }

    handleClick() {
        alert('ok');
    }

    render() {
        return (
            <RaisedButton
                label="Click me"
                onTouchTap={this.handleClick}
            />
        );
    }
}