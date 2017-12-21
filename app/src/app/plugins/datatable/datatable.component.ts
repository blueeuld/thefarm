import { Component, ElementRef } from '@angular/core';
import { Http } from '@angular/http';

@Component({
  templateUrl: 'datatable.component.html'
})
export class DataTableComponent {


  public data = [
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Wing',
      'email': 'tellus.eu.augue@arcu.com',
      'regDate': '2016-01-09T14:48:34-08:00',
      'city': 'Paglieta',
      'age': 25
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Whitney',
      'email': 'sed.dictum@Donec.org',
      'regDate': '2017-01-23T20:09:52-08:00',
      'city': 'Bear',
      'age': 32
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Oliver',
      'email': 'mauris@Craslorem.ca',
      'regDate': '2015-11-19T19:11:33-08:00',
      'city': 'Bruderheim',
      'age': 31
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Vladimir',
      'email': 'mi.Aliquam@Phasellus.net',
      'regDate': '2015-11-02T07:59:34-08:00',
      'city': 'Andenne',
      'age': 50
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Maggy',
      'email': 'ligula@acorciUt.edu',
      'regDate': '2017-02-25T15:42:17-08:00',
      'city': 'HomprŽ',
      'age': 24
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Unity',
      'email': 'Nunc.commodo@justo.org',
      'regDate': '2016-03-07T03:47:55-08:00',
      'city': 'Ried im Innkreis',
      'age': 23
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Ralph',
      'email': 'augue@penatibuset.net',
      'regDate': '2017-02-27T20:03:50-08:00',
      'city': 'Cwmbran',
      'age': 45
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Medge',
      'email': 'sagittis.augue@taciti.edu',
      'regDate': '2016-03-02T03:59:17-08:00',
      'city': 'Maranguape',
      'age': 21
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Orli',
      'email': 'nascetur@mipedenonummy.edu',
      'regDate': '2016-11-07T20:48:43-08:00',
      'city': 'Gibbons',
      'age': 38
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Ainsley',
      'email': 'morbi.tristique.senectus@enim.ca',
      'regDate': '2016-02-11T22:14:36-08:00',
      'city': 'Guardia Perticara',
      'age': 43
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Candice',
      'email': 'turpis.non.enim@fringillami.com',
      'regDate': '2015-04-23T12:29:39-07:00',
      'city': 'Aylmer',
      'age': 25
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Alexis',
      'email': 'lacinia.orci.consectetuer@dolorFuscefeugiat.ca',
      'regDate': '2016-08-18T12:06:56-07:00',
      'city': 'Halkirk',
      'age': 35
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Diana',
      'email': 'pede.Cras@a.edu',
      'regDate': '2016-12-24T00:53:04-08:00',
      'city': 'Palermo',
      'age': 31
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Tyrone',
      'email': 'ornare.In@duilectus.co.uk',
      'regDate': '2015-03-31T11:45:57-07:00',
      'city': 'Bellevue',
      'age': 36
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Brennan',
      'email': 'scelerisque.lorem@enim.net',
      'regDate': '2016-09-07T16:12:31-07:00',
      'city': 'Oxford County',
      'age': 38
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Lillith',
      'email': 'non@lectus.edu',
      'regDate': '2016-08-01T12:45:06-07:00',
      'city': 'Lillois-WitterzŽe',
      'age': 25
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Wayne',
      'email': 'at.egestas.a@Pellentesque.edu',
      'regDate': '2016-02-23T10:20:18-08:00',
      'city': 'Baie-Saint-Paul',
      'age': 32
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Vielka',
      'email': 'Nam.porttitor@Uttincidunt.ca',
      'regDate': '2016-07-18T19:26:59-07:00',
      'city': 'Rodgau',
      'age': 21
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Armando',
      'email': 'Aliquam@orciin.net',
      'regDate': '2016-12-07T17:31:26-08:00',
      'city': 'Khanewal',
      'age': 30
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Justin',
      'email': 'gravida.non.sollicitudin@placerataugue.edu',
      'regDate': '2016-09-23T20:17:41-07:00',
      'city': 'İslahiye',
      'age': 20
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Zorita',
      'email': 'enim@risus.org',
      'regDate': '2015-06-14T12:12:00-07:00',
      'city': 'Burdinne',
      'age': 20
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Mariam',
      'email': 'purus.mauris.a@odiosagittis.ca',
      'regDate': '2016-10-14T18:52:48-07:00',
      'city': 'Bharatpur',
      'age': 22
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Malik',
      'email': 'Nam@enimEtiam.org',
      'regDate': '2016-09-20T18:06:55-07:00',
      'city': 'Neerheylissem',
      'age': 28
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Claire',
      'email': 'sapien@Nullamlobortis.ca',
      'regDate': '2016-12-29T09:49:13-08:00',
      'city': 'San Fratello',
      'age': 24
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Hilel',
      'email': 'tempor@purusmaurisa.edu',
      'regDate': '2016-07-09T12:03:31-07:00',
      'city': 'La Cruz',
      'age': 30
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Alea',
      'email': 'vulputate@orciUt.ca',
      'regDate': '2015-03-21T02:28:40-07:00',
      'city': 'Leominster',
      'age': 43
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Nash',
      'email': 'Nunc.ullamcorper.velit@egetmetuseu.edu',
      'regDate': '2016-10-21T10:38:41-07:00',
      'city': 'Gravataí',
      'age': 20
    },
    {
      'img': 'https://www.gravatar.com/avatar/373fe6abfe729c319ccc4ba6ef9e0c7c?s=75&d=mm&r=pg',
      'name': 'Brennan',
      'email': 'Vestibulum@Sedpharetra.org',
      'regDate': '2016-06-06T22:37:33-07:00',
      'city': 'Carleton',
      'age': 31
    }
  ];

  public filterQuery = '';
  public rowsOnPage = 10;
  public sortBy = 'name';
  public sortOrder = 'asc';
  public SortName = '';

  constructor(private http: Http, private eleRef: ElementRef) {
    /*http.get('/assets/data.json')
      .subscribe((data)=> {
        setTimeout(()=> {
          this.data = data.json();
        }, 2000);
      });*/
  }

  public toInt(num: string) {
    return +num;
  }

  public sortByWordLength = (a: any) => {
    return a.name.length;
  }

  thClicked(st) {
    this.SortName = st;
    const elm = this.eleRef.nativeElement.querySelector('#' + st + ' a');
    elm.dispatchEvent(new Event('click'));
    // elm.click(); // this also works
  }
}
