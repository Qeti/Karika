import { Component } from '@angular/core';

@Component({
  selector: 'dashboard-sales',
  styleUrls: [ './dashboard.component.css' ],
  templateUrl: './dashboard.component.html'
})
export class SalesDashboardComponent {
  constructor() {
  }

  ngOnInit() {
    console.log('hello `SalesDashboard` component');
  }

}
