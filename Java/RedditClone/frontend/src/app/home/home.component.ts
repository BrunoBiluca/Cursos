import { Component, OnInit } from '@angular/core';
import { PostModel } from '../shared/post-model.payload';
import { PostService } from '../shared/post.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

  posts$: Array<PostModel> = []

  constructor(private postService: PostService) { }

  ngOnInit(): void {
    this.postService.getAll().subscribe(posts => {
      this.posts$ = posts;
    });
  }

}
