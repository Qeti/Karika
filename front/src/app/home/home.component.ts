import { Component } from '@angular/core';

import { AppState } from '../app.service';
import { Title } from './title';
import { XLarge } from './x-large';

@Component({
  // The selector is what angular internally uses
  // for `document.querySelectorAll(selector)` in our index.html
  // where, in this case, selector is the string 'home'
  selector: 'home',  // <home></home>
  // We need to tell Angular's Dependency Injection which providers are in our app.
  providers: [
    Title
  ],
  // Our list of styles in our component. We may add more to compose many styles together
  styleUrls: [ './home.component.css' ],
  // Every Angular template is first compiled by the browser before Angular runs it's compiler
  templateUrl: './home.component.html'
})
export class HomeComponent {
  selection: string;
  count: number;
  rows: Array<any> = [
    {'id': 0, 'name': 'АиФ', 'status': 'Active', 'contacts': 'info@aif.ru', 'manager': 'Gorinich K.B.'},
    {'id': 1, 'name': 'IBM', 'status': 'Perspective', 'contacts': 'info@ibm.com, +7(124)613-11-22', 'manager': 'Gorinich K.B.'},
    {'id': 2, 'name': 'АиФ', 'status': 'Active', 'contacts': 'info@aif.ru', 'manager': 'Gorinich K.B.'},
    {'id': 3, 'name': 'Hyndai Motors', 'status': 'Active', 'contacts': '', 'manager': 'Ded Moroz'},
    {'id': 4, 'name': 'Avtodom', 'status': 'Active', 'contacts': '', 'manager': 'Snegurochka.'},
    {'id': 5, 'name': 'Uniliver', 'status': 'Perspective', 'contacts': '+4(234)111-23-41', 'manager': 'Morkovkin S.'},
    {'id': 6, 'name': 'IBM', 'status': 'Perspective', 'contacts': 'info@ibm.com, +7(124)613-11-22', 'manager': 'Gorinich K.B.'},
    {'id': 7, 'name': 'АиФ', 'status': 'Active', 'contacts': 'info@aif.ru', 'manager': 'Gorinich K.B.'},
    {'id': 8, 'name': 'Hyndai Motors', 'status': 'Active', 'contacts': '', 'manager': 'Ded Moroz'},
    {'id': 9, 'name': 'Avtodom', 'status': 'Active', 'contacts': '', 'manager': 'Snegurochka.'},
    {'id': 10, 'name': 'Uniliver', 'status': 'Perspective', 'contacts': '+4(234)111-23-41', 'manager': 'Morkovkin S.'},
    {'id': 11, 'name': 'Hyndai Motors', 'status': 'Active', 'contacts': '', 'manager': 'Ded Moroz'},
    {'id': 12, 'name': 'Avtodom', 'status': 'Active', 'contacts': '', 'manager': 'Snegurochka.'},
    {'id': 13, 'name': 'Uniliver', 'status': 'Perspective', 'contacts': '+4(234)111-23-41', 'manager': 'Morkovkin S.'},
    {'id': 14, 'name': 'IBM', 'status': 'Perspective', 'contacts': 'info@ibm.com, +7(124)613-11-22', 'manager': 'Gorinich K.B.'},
    {'id': 15, 'name': 'АиФ', 'status': 'Active', 'contacts': 'info@aif.ru', 'manager': 'Gorinich K.B.'},
  ];

  pagination = {
    currentPage: 1,
    itemsPerPage: 5,
    totalItems: 24
  };
  availableLength: Array<number> = [5, 10, 20];
  pagedRows: Array<any> = [];


  // Set our default values
  localState = { value: '' };
  // TypeScript public modifiers
  constructor(public appState: AppState, public title: Title) {
    this.refreshMaterials();
  }

  ngOnInit() {
    console.log('hello `Home` component');
    // this.title.getData().subscribe(data => this.data = data);
  }

  submitState(value: string) {
    console.log('submitState', value);
    this.appState.set('value', value);
    this.localState.value = '';
  }

  refreshMaterials() {
    let start = (this.pagination.currentPage - 1) * this.pagination.itemsPerPage,
      end = start + this.pagination.itemsPerPage;
    this.pagedRows = this.rows.slice(start, end);
  }
  detectChange(event) {
    if (event !== undefined && event.name === 'pagination_changed' && event.pagination !== undefined) {
      this.pagination = event.pagination;
      this.refreshMaterials();
    }
  }

}
