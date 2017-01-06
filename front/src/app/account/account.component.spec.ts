import {
  inject,
  TestBed
} from '@angular/core/testing';
import { Component } from '@angular/core';
import {
  BaseRequestOptions,
  ConnectionBackend,
  Http
} from '@angular/http';
import { MockBackend } from '@angular/http/testing';

// Load the implementations that should be tested
import { AppState } from '../app.service';
import { AccountComponent } from './account.component';

describe('Account', () => {
  // provide our implementations or mocks to the dependency injector
  beforeEach(() => TestBed.configureTestingModule({
    providers: [
      BaseRequestOptions,
      MockBackend,
      {
        provide: Http,
        useFactory: function(backend: ConnectionBackend, defaultOptions: BaseRequestOptions) {
          return new Http(backend, defaultOptions);
        },
        deps: [MockBackend, BaseRequestOptions]
      },
      AppState,
      AccountComponent
    ]
  }));

  it('should have default data', inject([ AccountComponent ], (account: AccountComponent) => {
    expect(account.localState).toEqual({ value: '' });
  }));

  it('should log ngOnInit', inject([ AccountComponent ], (account: AccountComponent) => {
    spyOn(console, 'log');
    expect(console.log).not.toHaveBeenCalled();

    account.ngOnInit();
    expect(console.log).toHaveBeenCalled();
  }));

});
