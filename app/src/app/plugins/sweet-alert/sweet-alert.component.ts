import { Component, ViewChild } from '@angular/core';

@Component({
  templateUrl: 'sweet-alert.component.html',
})

export class SweetAlertComponent {

  @ViewChild('noDelete') private swalDialogNoDelete;

  public saveEmail(email: string): void {
    // ... save user email
  }
  public handleRefusalToSetEmail(dismissMethod: string): void {
    // dismissMethod can be 'cancel', 'overlay', 'close', and 'timer'
    // ... do something
  }
}
