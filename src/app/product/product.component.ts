import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

/*
 * We're loading this component asynchronously
 * We are using some magic with es6-promise-loader that will wrap the module with a Promise
 * see https://github.com/gdi2290/es6-promise-loader for more info
 */

console.log('`Product` component loaded asynchronously');

@Component({
  selector: 'product',
  styles: [`
  `],
  template: `
    <h1>Product</h1>
    <md-card>
      <form (ngSubmit)="submitState(localState.value)" autocomplete="off">

        <md-input
          [value]="localState.value"
          (input)="localState.value = $event.target.value"
          placeholder="Submit Local State to App State"
          autofocus></md-input>
  
        <button id="submit-button" md-raised-button color="accent">Submit Value</button>
      </form>
    </md-card>
    <md-card><pre>this.localState = {{ localState | json }}</pre></md-card>
  `
})
export class ProductComponent {
  localState = { value: '' };
  constructor(public route: ActivatedRoute) {

  }

  ngOnInit() {
    console.log('hello `Product` component');
    // this.title.getData().subscribe(data => this.data = data);
  }

  submitState(value: string) {
    console.log('submitState', value);
    this.localState.value = value;
  }

}
