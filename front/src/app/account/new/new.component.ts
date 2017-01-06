import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'new',  // <home></home>
  templateUrl: './new.component.html'
})
export class AccountNewComponent {

  constructor(private router: Router) {
  }

  ngOnInit() {
    console.log('hello `Edit` component');
  }
}
