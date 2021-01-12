import { Component, Input, OnInit } from '@angular/core';
import { faArrowDown, faArrowUp } from '@fortawesome/free-solid-svg-icons';
import { PostModel } from '../post-model.payload';

@Component({
  selector: 'app-vote-button',
  templateUrl: './vote-button.component.html',
  styleUrls: ['./vote-button.component.scss']
})
export class VoteButtonComponent implements OnInit {

  @Input() post: PostModel;
  faArrowUp = faArrowUp;
  faArrowDown = faArrowDown;

  upvoteColor = "green";
  downvoteColor = "#878787";

  constructor() {
  }

  ngOnInit() {

  }

  upvotePost(){}

  downvotePost(){}

}
