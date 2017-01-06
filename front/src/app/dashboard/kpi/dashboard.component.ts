import { Component } from '@angular/core';

@Component({
  selector: 'dashboard-kpi',
  styleUrls: [ './dashboard.component.css' ],
  templateUrl: './dashboard.component.html'
})
export class KpiDashboardComponent {
  constructor() {
  }

  ngOnInit() {
    console.log('hello `KpiDashboard` component');
  }

}
