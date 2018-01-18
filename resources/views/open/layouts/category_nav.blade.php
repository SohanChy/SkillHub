<div id="menu" class="mui--hide">
    <ul>

        @foreach($categoryNavData as $key => $singleCategoryData)

        <li>
            <span>{{$singleCategoryData[0]->category_name}}</span>
            <ul id="sub-categories-{{$key}}">

                @foreach($singleCategoryData as $courseData)
                <li class="img">
                    <a href="{{\App\Course::makeUrl($courseData->course_id,$courseData->course_title)}}">
                        <img src="https://www.iconexperience.com/_img/o_collection_png/green_dark_grey/512x512/plain/atom2.png" style="background-color: #f66;" />
                        {{$courseData->course_title}}<br />
                        <small>{{$courseData->teacher_name}} - {{$courseData->teacher_edu}}</small>
                    </a>
                </li>
                @endforeach

            </ul>
        </li>

        @endforeach

    </ul>
</div>