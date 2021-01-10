import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../shared/auth.service';
import { LoginRequest } from './login-request.payload'

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  loginForm!: FormGroup;
  isError: boolean = false;

  constructor(private authService: AuthService) { }

  ngOnInit(): void {
    this.loginForm = new FormGroup({
      username: new FormControl('', Validators.required),
      password: new FormControl('', Validators.required)
    })
  }

  login() {
    let payload: LoginRequest = {
      username: this.loginForm.get('username').value,
      password: this.loginForm.get('password').value
    }

    this.authService.login(payload)
      .subscribe(() => {
        console.log("Login Successful")
      }, () => {
        console.log("Login Failed")
      })
  }

}
