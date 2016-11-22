import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Http } from '@angular/http';

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
                    placeholder="Enter product price"
                    autofocus></md-input>
          
                <button id="submit-button" md-raised-button color="accent">Find products</button>
            </form>
        </md-card>
        <br/>
        <md-card>
            <h4>Found</h4>
            <ul>
                <li *ngFor="let item of localState.items">{{ item.name }}</li>        
            </ul>
        </md-card>
        <br/>
        <md-card>
            <pre>this.localState = {{ localState | json }}</pre>
        </md-card>
        <br/>
    `
})
export class ProductComponent {
    localState = {
        value: '',
        items: []
    };
    constructor(public route: ActivatedRoute, private http: Http) {

    }

    ngOnInit() {
        console.log('hello `Product` component');
      //   this.title.getData().subscribe(data => this.data = data);
    }

    submitState(value: string) {
        console.log('submitState', value);
        this.localState.value = value;
        let url = 'api/products';
        if (value) {
            url += `?filters[price]=${value}`;
        }
        return this.http
            .get(url)
            .map(res => res.json())
            .subscribe(products => {
                this.localState.items = products;
            }, response => {
                this.localState.value = 'Sorry, error';
            });
    }
}
