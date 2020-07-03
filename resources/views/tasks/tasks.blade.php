@if (count($tasks) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>タスク一覧</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($tasks as $task)
                <tr>
                    {{-- メッセージ詳細ページへのリンク --}}
                    <td>{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</td>
                    <td>{!! nl2br(e($task->content)) !!}</td>
                    <td>{!! nl2br(e($task->status)) !!}</td>
                </tr>
                @endforeach
        </tbody>
    </table>
@endif