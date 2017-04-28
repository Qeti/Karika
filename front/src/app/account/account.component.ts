import { Component } from '@angular/core';

import { AppState } from '../app.service';

@Component({
  // The selector is what angular internally uses
  // for `document.querySelectorAll(selector)` in our index.html
  // where, in this case, selector is the string 'account'
  selector: 'account',  // <account></account>
  // Our list of styles in our component. We may add more to compose many styles together
  styleUrls: [ './account.component.css' ],
  // Every Angular template is first compiled by the browser before Angular runs it's compiler
  templateUrl: './account.component.html'
})
export class AccountComponent {

  // Set our default values
  localState = { value: '' };
  // TypeScript public modifiers
  constructor(public appState: AppState) {
  }

  ngOnInit() {
    console.log('hello `Account` component');
  }

}
