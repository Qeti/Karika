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
  <md-sidenav-container [class.m2app-dark]="isDarkTheme">

    <md-sidenav #sidenav [opened]="true" mode="side" class="app-sidenav">
      <md-toolbar>
        <a [routerLink]=" ['./']"><img [src]="projectLogo" class="logo"></a>&nbsp;
        <h2><a [routerLink]=" ['./']">Karika</a></h2>
      </md-toolbar>
      <md-list>
        <md-list-item>
          <md-input placeholder="Search"></md-input>
        </md-list-item>

        <h3 md-subheader>Dashboard</h3>
        <md-list-item md-ink role="listitem">
          <button md-ripple md-button [routerLink]=" ['./']"><md-icon>timeline</md-icon> Sales</button>
        </md-list-item>
        <md-list-item md-ink role="listitem">
          <button md-ripple md-button [routerLink]=" ['./']"><md-icon>assessment</md-icon> KPI</button>
        </md-list-item>

        <h3 md-subheader>CRM</h3>
        <md-list-item md-ink role="listitem">
          <button md-ripple md-button [routerLink]=" ['./']"><md-icon>account_balance</md-icon> Accounts</button>
        </md-list-item>
        <md-list-item>
          <button md-ripple md-button [routerLink]=" ['./']"><md-icon>account_box</md-icon> Contacts</button>
        </md-list-item>
        <md-list-item>
          <button md-ripple md-button [routerLink]=" ['./']"><md-icon>assignment</md-icon> Tasks</button>
        </md-list-item>
      </md-list>
    </md-sidenav>

    <md-toolbar>
      <button md-icon-button (click)="sidenav.toggle()">
        <md-icon>menu</md-icon>
      </button>

      <span class="right">
        <a md-button [routerLink]=" ['./home'] ">
          Accounts
        </a>
        <a md-button [routerLink]=" ['./about'] ">
          Sales
        </a>
        <a md-button [routerLink]=" ['./detail'] ">
          Tasks
        </a>
        <a md-button [routerLink]=" ['./product'] ">
          Product
        </a>
        <button md-icon-button>
          <md-icon>add</md-icon>
        </button>
      </span>
      
      <span class="app-toolbar-filler"></span>

      <button md-icon-button>
        <md-icon>mail_outline</md-icon>
      </button>
      <button md-icon-button>
        <md-icon>notifications_none</md-icon>
      </button>
      <button md-icon-button>
        <md-icon>assignment</md-icon>
      </button>

      <span class="app-toolbar-separator"></span>
      <a href="#"><img md-card-avatar src="https://source.unsplash.com/random/200x200"></a>&nbsp;<a href="#" class="md-body-2">mnv</a>
      <span class="app-toolbar-separator"></span>

      <button md-icon-button (click)="isDarkTheme = !isDarkTheme">
        <md-icon>invert_colors</md-icon>
      </button>
      <button md-icon-button>
        <md-icon>settings</md-icon>
      </button>
    </md-toolbar>

    <div class="app-content">
      
      <main>
        <router-outlet></router-outlet>
      </main>
  
      <footer>
        <a [href]="url"><img [src]="companyLogo" class="logo"></a>
        <span>Karika by <a [href]="url">Qeti</a></span>
      </footer>
    </div>
    
  </md-sidenav-container>
  
  <span class="app-action" [class.m2app-dark]="isDarkTheme">
  </span>
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
