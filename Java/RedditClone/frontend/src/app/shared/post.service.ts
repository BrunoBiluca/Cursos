import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { PostModel } from './post-model.payload';

@Injectable({
  providedIn: 'root'
})
export class PostService {

  constructor(private http: HttpClient) { }

  public getAll(): Observable<Array<PostModel>> {
    return this.http.get<Array<PostModel>>("http://localhost:8080/api/posts");
  }

}
