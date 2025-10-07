@extends('admin.layout')

@section('admin')
  <form method="POST" class="card grid gap-4"
        action="{{ $lesson->exists ? route('admin.lessons.update', $lesson) : route('admin.lessons.store') }}">
    @csrf
    @if($lesson->exists) @method('PUT') @endif

    <div>
      <label class="block text-sm">Chapter</label>
      <select class="mt-1 w-full rounded-md border-gray-300" name="chapter_id" required>
        @foreach($chapters as $c)
          <option value="{{ $c->id }}" @selected(old('chapter_id',$lesson->chapter_id)==$c->id)>{{ $c->title }}</option>
        @endforeach
      </select>
      @error('chapter_id')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="grid sm:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm">Title</label>
        <input class="mt-1 w-full rounded-md border-gray-300" name="title" value="{{ old('title',$lesson->title) }}" required>
        @error('title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm">Slug</label>
        <input class="mt-1 w-full rounded-md border-gray-300" name="slug" value="{{ old('slug',$lesson->slug) }}" required>
        @error('slug')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
      </div>
    </div>

    <div>
      <label class="block text-sm">Summary</label>
      <input class="mt-1 w-full rounded-md border-gray-300" name="summary" value="{{ old('summary',$lesson->summary) }}">
      @error('summary')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    {{-- Markdown editor with preview --}}
    <div x-data="markdownEditor()" class="grid gap-2">
      <label class="block text-sm">Body (Markdown)</label>

      <div class="flex flex-wrap gap-2">
        <button type="button" class="badge" @click="wrap('**','**')">Bold</button>
        <button type="button" class="badge" @click="wrap('_','_')">Italic</button>
        <button type="button" class="badge" @click="prefix('# ')">H1</button>
        <button type="button" class="badge" @click="prefix('## ')">H2</button>
        <button type="button" class="badge" @click="prefix('- ')">List</button>
        <button type="button" class="badge" @click="wrap('`','`')">Code</button>
        <button type="button" class="badge" @click="wrap('```\\n','\\n```')">Code block</button>
        <button type="button" class="badge" @click="tab='edit'">Edit</button>
        <button type="button" class="badge" @click="tab='preview'; render()">Preview</button>
      </div>

      <template x-if="tab==='edit'">
        <textarea
          x-ref="ta"
          class="mt-1 w-full rounded-md border-gray-300 min-h-[350px]"
          name="body"
          x-model="text"
        >{{ old('body',$lesson->body) }}</textarea>
      </template>

      <template x-if="tab==='preview'">
        <div class="card prose max-w-none" x-html="html"></div>
      </template>

      @error('body')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="grid sm:grid-cols-3 gap-4">
      <div>
        <label class="block text-sm">Position</label>
        <input type="number" class="mt-1 w-full rounded-md border-gray-300" name="position" value="{{ old('position',$lesson->position ?? 1) }}" min="1" required>
        @error('position')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm">Minutes</label>
        <input type="number" class="mt-1 w-full rounded-md border-gray-300" name="estimated_minutes" value="{{ old('estimated_minutes',$lesson->estimated_minutes ?? 5) }}" min="1" max="240" required>
        @error('estimated_minutes')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm">Published at</label>
        <input type="datetime-local" class="mt-1 w-full rounded-md border-gray-300" name="published_at" value="{{ old('published_at', optional($lesson->published_at)->format('Y-m-d\TH:i')) }}">
        @error('published_at')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
      </div>
    </div>

    <div><button class="badge">Save</button></div>
  </form>
@endsection

@push('scripts')
<script type="module">
  import { marked } from '/node_modules/marked/lib/marked.esm.js';
  import DOMPurify from '/node_modules/dompurify/dist/purify.es.js';

  window.markdownEditor = () => ({
    tab: 'edit',
    text: @json(old('body', $lesson->body)),
    html: '',
    render() { this.html = DOMPurify.sanitize(marked.parse(this.text || '')); },
    wrap(before, after) {
      const ta = this.$refs.ta;
      const [start,end] = [ta.selectionStart, ta.selectionEnd];
      const v = this.text || '';
      this.text = v.slice(0,start) + before + v.slice(start,end) + after + v.slice(end);
      this.$nextTick(()=>{ ta.focus(); ta.setSelectionRange(start+before.length, end+before.length); });
    },
    prefix(token) {
      const ta = this.$refs.ta;
      const v = this.text || '';
      const [start,end] = [ta.selectionStart, ta.selectionEnd];
      const pre = v.slice(0,start), mid = v.slice(start,end), post = v.slice(end);
      const lines = mid.split('\n').map(l => l.startsWith(token)? l : token + l).join('\n');
      this.text = pre + lines + post;
      this.$nextTick(()=> ta.focus());
    }
  });
</script>
@endpush
