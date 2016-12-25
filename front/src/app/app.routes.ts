import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './home';
import { EditComponent } from './home/edit';
import { NewComponent } from './home/new';
import { AboutComponent } from './about';
import { ProductComponent } from './product';
import { NoContentComponent } from './no-content';

import { DataResolver } from './app.resolver';


export const ROUTES: Routes = [
  { path: '',      component: HomeComponent },
  { path: 'home',  component: HomeComponent },
  { path: 'home/edit/:id', component: EditComponent },
  { path: 'home/new', component: NewComponent },
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
