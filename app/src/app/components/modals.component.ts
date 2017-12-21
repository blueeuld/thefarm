import { Component, ViewChild, TemplateRef  } from '@angular/core';
import { ModalDirective } from 'ngx-bootstrap/modal/modal.component';
import { BsModalService } from 'ngx-bootstrap/modal';
import { BsModalRef } from 'ngx-bootstrap/modal/modal-options.class';

@Component({
  templateUrl: 'modals.component.html'
})
export class ModalsComponent {
    public myModal;
    public largeModal;
    public smallModal;
    public primaryModal;
    public successModal;
    public warningModal;
    public dangerModal;
    public infoModal;


    public modalRef: BsModalRef;
    constructor(private modalService: BsModalService) {}

    public openModal(template: TemplateRef<any>) {
        this.modalRef = this.modalService.show(template, {
            keyboard: false, backdrop: 'static', ignoreBackdropClick: true, class: 'modal-lg modal-primary'
        });
    }

}
