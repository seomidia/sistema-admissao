@component('mail::message')
# Notificação de admissão.

Ola, um formulario de admissão acaba de ser atualizado,
acesse o link abaixo.

@component('mail::button', ['url' => url('/') . "/admissao/{$admission->id}/solicitacao"])
Admissão
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
