import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'edit',  // <home></home>
  templateUrl: './edit.component.html'
})
export class AccountEditComponent {

  constructor(private router: Router) {
  }

  ngOnInit() {
    console.log('hello `Edit` component');
  }
}
