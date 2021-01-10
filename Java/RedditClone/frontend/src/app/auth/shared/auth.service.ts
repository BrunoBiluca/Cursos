import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http'
import { SignupRequestPayload } from '../sign-up/signup-request.payload';
import { Observable } from 'rxjs';
import { LoginRequest } from '../login/login-request.payload';
import { map } from 'rxjs/operators'
import { LocalStorageService } from 'ngx-webstorage';
import { LoginResponse } from '../login/login-response.payload';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(
    private http: HttpClient,
    private localStorage: LocalStorageService
  ) { }

  signup(payload: SignupRequestPayload): Observable<any>{
    return this.http.post('http://localhost:8080/api/auth/signup', payload, { responseType: 'text' });
  }

  login(payload: LoginRequest): Observable<any>{
    return this.http.post<LoginResponse>('http://localhost:8080/api/auth/login', payload)
      .pipe(map(data => {
        this.localStorage.store('authenticationToken', data.authenticationToken);
        this.localStorage.store('username', data.username);
        this.localStorage.store('refreshToken', data.refreshToken);
        this.localStorage.store('expiresAt', data.expiresAt);
        return true;
      }))
  }
}
