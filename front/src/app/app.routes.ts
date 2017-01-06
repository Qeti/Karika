import { Routes, RouterModule } from '@angular/router';
import { AccountComponent } from './account';
import { AccountNewComponent} from './account/new';
import { AccountEditComponent } from './account/edit';
import { AboutComponent } from './about';
import { ProductComponent } from './product';
import { NoContentComponent } from './no-content';
import { SalesDashboardComponent } from './dashboard/sales';
import { KpiDashboardComponent } from './dashboard/kpi';

import { DataResolver } from './app.resolver';


export const ROUTES: Routes = [
  { path: '',      component: AccountComponent },

  { path: 'dashboard/sales',  component: SalesDashboardComponent },
  { path: 'dashboard/kpi',  component: KpiDashboardComponent },

  { path: 'account',  component: AccountComponent },
  { path: 'account/edit/:id', component: AccountEditComponent },
  { path: 'account/new', component: AccountNewComponent },

  { path: 'about', component: AboutComponent },
  { path: 'product', component: ProductComponent },
  {
    path: 'detail', loadChildren: () => System.import('./+detail/index').then((comp: any) => {
      return comp.default;
    })
    ,
  },
  { path: '**',    component: NoContentComponent },
];
