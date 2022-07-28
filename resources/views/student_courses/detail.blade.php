@extends('layouts.front')

@section('content')
    <style>

        .ql-container.ql-snow {
            border: none;
        }
        .ql-editor {
            box-sizing: border-box;
            line-height: 1.42;
            height: 100%;
            outline: none;
            overflow-y: auto;
            padding: 0px;
            tab-size: 4;
            -moz-tab-size: 4;
            text-align: left;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .ql-snow .ql-editor pre.ql-syntax {
            background-color: #f3f3f3;
            color: #1f1f1f;
            overflow: visible;
        }
    </style>
    <section class="section mt-5" id="interactive">
        <div class="row">
            <div class="col-md-8">
                <div>
                    <div class="card">
                        <div class="card-body">
                            <h1>{{ $course->course_name }}</h1>
                            <div class="mt-1">
                                <span class="badge text-bg-primary badge-primary rounded-pill">{{ $course->lessons->count() }} Lessons</span>
                                <span class="badge text-bg-primary badge-secondary rounded-pill">{{ $course->student_courses->count() }} Students</span>
                            </div>
                            <p class="mt-3">{{ $course->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-1">
                    <div class="card">
                        <div class="card-body">
                            <h3>Leader Board</h3>
                            <div class="table-responsive">
                              <table class="table table-striped" id="sortable-table">
                                <thead>
                                  <tr>
                                    <th>
                                      Rank
                                    </th>
                                    <th>Name</th>
                                    <th>Point</th>
                                    <th>Progress</th>
                                    <th>Badge</th>
                                  </tr>
                                </thead>
                                <tr>
                                  <!-- <td>
                                    <div class="sort-handler">
                                      <i class="fas fa-th"></i>
                                    </div>
                                  </td> -->
                                  <?php $no = 1; ?>
                                  @foreach($leader_board as $leader)
                                  <td> <?= $no ?> </td>
                                  <td> {{ ucfirst($leader->user->name) }} </td>
                                  <td> {{ $leader->total_score }}
                                    <img class="" src="{{ asset('img/pngwing.com.png') }}" width="23px" alt=""/>
                                   </td>
                                  <td>
                                    <div class="progress mt-2">
                                      <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;"
                                        aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $percentage }}%</div>
                                    </div>
                                  </td>
                                  <td>
                                    {{  $current_badge->name  }}
                                    <img src="/image_upload/{{ $current_badge->file }}" width="50px">
                                  </td>
                                  <?php $no += 1; ?>
                                  @endforeach
                                </tr>
                              </div>
                            </table>
                            <!-- <div class="list-group row list-group-flush">
                                @foreach($leader_board as $leader)
                                    <li class="list-group-item list-group-item-action">
                                        {{ ucfirst($leader->user->name) }}<br />
                                        {{  $current_badge->name  }}
                                        <small>Total Score : <b>{{ $leader->total_score }}</b></small>
                                        <div class="progress mt-2">
                                          <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;"
                                            aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ $percentage }}%</div>
                                        </div>
                                    </li>
                                @endforeach
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Lesson Content
                        </h5>
                        <div class="accordion" id="accordionExample">
                            @foreach($course->lessons as $index=>$lesson)
                                <div class="accordion-item">
                                    <div  class="accordion-header" data-toggle="collapse"
                                          data-target="#item{{$index}}"
                                          aria-expanded="{{ $index==0 ? "true" : "false" }}" aria-controls="collapseOne">
                                        {{ $lesson->title }}
                                    </div>
                                    <div id="item{{$index}}"
                                         class="accordion-collapse collapse {{ $index == 0 ? "show": "" }}"
                                         aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="list-group row list-group-flush">
                                                @foreach($lesson->contents as $content)
                                                    <li
                                                       class="list-group-item list-group-item-action}}"
                                                    >
                                                        {{ $content->title }}</li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section("scripts")
    <script type="text/javascript">
        hljs.configure({   // optionally configure hljs
            languages: ['javascript', 'ruby', 'python', 'java']
        });

        var quill = new Quill('#res', {
            modules: {
                syntax: true,
                toolbar: false
            },
            theme: 'snow',
            onChange:(value) => {
                console.log(value)
            },
            readOnly:true
        });

    </script>
@endsection
