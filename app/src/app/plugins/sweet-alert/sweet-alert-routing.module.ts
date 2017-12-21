import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { SweetAlertComponent } from './sweet-alert.component';

const routes: Routes = [
  {
    path: '',
    component: SweetAlertComponent,
    data: {
      title: 'Sweet Alert'
    }
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class SweetAlertRoutingModule {}
