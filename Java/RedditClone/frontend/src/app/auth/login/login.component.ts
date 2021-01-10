import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { AuthService } from '../shared/auth.service';
import { LoginRequest } from './login-request.payload'

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  loginForm!: FormGroup;
  registerSuccessMessage: string; 
  isError: boolean = false;

  constructor(
    private authService: AuthService,
    private activatedRoute: ActivatedRoute,
    private router: Router,
    private toastr: ToastrService
  ) { }

  ngOnInit(): void {
    this.loginForm = new FormGroup({
      username: new FormControl('', Validators.required),
      password: new FormControl('', Validators.required)
    });

    this.activatedRoute.queryParams
      .subscribe(params => {
        console.log(params)
        if(params.registered === 'true'){
          this.toastr.success("Signup Successful!");
          this.registerSuccessMessage = "Please check your inbox for "
           + "activation email activate your account before you login!";
        }
      })
  }

  login() {
    let payload: LoginRequest = {
      username: this.loginForm.get('username').value,
      password: this.loginForm.get('password').value
    }

    this.authService.login(payload)
      .subscribe(data => {
        if (!data) {
          this.isError = true;
          return;
        }

        this.isError = false;
        this.router.navigateByUrl('/');
        this.toastr.success('Login Successful');
      }, () => {
        console.log("Login Failed")
      })
  }

}
