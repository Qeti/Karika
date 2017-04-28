/*
 * Angular 2 decorators and services
 */
import { Component, ViewEncapsulation } from '@angular/core';
import { AppState } from './app.service';

/*
 * App Component
 * Top Level Component
 */
@Component({
  selector: 'app',
  encapsulation: ViewEncapsulation.None,
  styleUrls: [
    './app.component.css',
    './theme.scss'
  ],
  template: `
        <a [routerLink]=" ['./']"><img [src]="projectLogo" class="logo"></a>&nbsp;
        <h2><a [routerLink]=" ['./']">Karika</a></h2>
          <button md-ripple md-button [routerLink]=" ['./dashboard/sales']"><md-icon>timeline</md-icon> Sales</button>
          <button md-ripple md-button [routerLink]=" ['./dashboard/kpi']"><md-icon>assessment</md-icon> KPI</button>
          <button md-ripple md-button [routerLink]=" ['./account']"><md-icon>account_balance</md-icon> Accounts</button>
          <button md-ripple md-button [routerLink]=" ['./']"><md-icon>account_box</md-icon> Contacts</button>
          <button md-ripple md-button [routerLink]=" ['./']"><md-icon>assignment</md-icon> Tasks</button>

    <div class="app-content">
      
      <main>
        <router-outlet></router-outlet>
      </main>
  
      <footer>
        <a [href]="url"><img [src]="companyLogo" class="logo"></a>
        <span>Karika by <a [href]="url">Qeti</a></span>
      </footer>
    </div>
  `
})
export class AppComponent {
  companyLogo = 'build/assets/img/company-logo.jpg';
  projectLogo = 'build/assets/img/project-logo.png';
  name = 'Karika';
  url = 'https://github.com/qeti';

  isDarkTheme: boolean = false;

  constructor(
    public appState: AppState) {

  }

  ngOnInit() {
    console.log('Initial App State', this.appState.state);
  }

}
