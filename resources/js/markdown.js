import { marked } from 'marked'
import DOMPurify from 'dompurify'

window.createMarkdownEditor = (initialText = '') => ({
  tab: 'edit',
  text: initialText,
  html: '',
  render() {
    this.html = DOMPurify.sanitize(marked.parse(this.text || ''))
  },
  wrap(before, after) {
    const ta = this.$refs.ta
    if (!ta) return
    const s = ta.selectionStart ?? 0
    const e = ta.selectionEnd ?? 0
    const v = this.text || ''
    this.text = v.slice(0, s) + before + v.slice(s, e) + after + v.slice(e)
    this.$nextTick(() => {
      ta.focus()
      ta.setSelectionRange(s + before.length, e + before.length)
    })
  },
  prefix(token) {
    const ta = this.$refs.ta
    if (!ta) return
    const s = ta.selectionStart ?? 0
    const e = ta.selectionEnd ?? 0
    const v = this.text || ''
    const pre = v.slice(0, s)
    const mid = v.slice(s, e)
    const post = v.slice(e)
    const lines = (mid || '').split('\n').map(l => (l.startsWith(token) ? l : token + l)).join('\n')
    this.text = pre + lines + post
    this.$nextTick(() => ta.focus())
  },
})
