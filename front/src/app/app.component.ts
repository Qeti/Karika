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
  <md-sidenav-layout [class.m2app-dark]="isDarkTheme">

    <md-sidenav #sidenav [opened]="true" mode="side" layout-padding class="app-sidenav">
      <h2><a [routerLink]=" ['./']"><img [src]="projectLogo" class="logo"></a> Karika</h2>
      <br/>
      <button md-raised-button class="md-raised md-primary" #mybutton (click)="sidenav.close()">Close</button>
    </md-sidenav>

    <md-toolbar color="primary">
      <button class="app-icon-button" (click)="sidenav.toggle()">
        <i class="material-icons app-toolbar-menu">menu</i>
      </button>

      <button md-icon-button [md-menu-trigger-for]="menu">
        <md-icon>more_vert</md-icon>
      </button>

      <md-menu #menu="mdMenu">
        <button md-menu-item [routerLink]=" ['./'] "> Index </button>
        <button md-menu-item [routerLink]=" ['./home'] ">
          <md-icon> home </md-icon>
          <span> Home </span>
        </button>
        <button md-menu-item disabled> Disabled option </button>
      </md-menu>
      <span class="right">
        <button md-button [routerLink]=" ['./'] ">
          Index
        </button>
        <button md-button [routerLink]=" ['./home'] ">
          Home
        </button>
        <button md-button [routerLink]=" ['./detail'] ">
          Detail
        </button>
        <button md-button [routerLink]=" ['./product'] ">
          Product
        </button>
        <button color="accent" md-raised-button [routerLink]=" ['./about'] ">
          About
        </button>
        <button md-raised-button color="warn" (click)="isDarkTheme = !isDarkTheme">TOGGLE THEME</button>
      </span>
    </md-toolbar>

    <div class="app-content">
      
      <main>
        <router-outlet></router-outlet>
      </main>
  
      <md-card><pre class="app-state">this.appState.state = {{ appState.state | json }}</pre></md-card>
  
      <md-card class="wide-card">
        <md-data-table>
          <thead>
          <tr>
            <th class="md-text-cell">Material</th>
            <th>Quantity</th>
            <th>Unit price</th>
          </tr>
          </thead>
          <tbody>
          <tr *ngFor="let material of materials">
            <td class="md-text-cell">{{ material.name }}</td>
            <td>{{ material.quantity }}</td>
            <td>{{ material.price }}</td>
          </tr>
          </tbody>
        </md-data-table>
      </md-card>

      <footer>
        <a [href]="url"><img [src]="companyLogo" class="logo"></a>
        <span>Karika by <a [href]="url">Qeti</a></span>
      </footer>
    </div>
    
  </md-sidenav-layout>
  
  <span class="app-action" [class.m2app-dark]="isDarkTheme">
  </span>
  `
})
export class AppComponent {
  materials: Array<any> = [
    {'id': 1, 'name': 'Acrylic (Transparent)', 'quantity': '25', 'price': '$2.90'},
    {'id': 2, 'name': 'Plywood (Birch)', 'quantity': '50', 'price': '$1.25'},
    {'id': 3, 'name': 'Laminate (Gold on Blue)', 'quantity': '10', 'price': '$2.35'}
  ];

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
