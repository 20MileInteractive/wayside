$ ->
	$(document).foundation()
	# Write scripts here

	handleErrors = ( data )->
		switch data.error_type
			when 'empty_field'
				for field in data.fields
					$("[name=#{field}]").addClass('error')

	toggleEmailSent = ()->
		$('#contact').hide();
		$('#thank-you').show();
		return true


	xhr = null

	$('#contact').on 'submit', ()->
		contact_form = $(@)
		$('input, textarea').removeClass('error')
		xhr.abort() if xhr
		xhr = $.ajax @.action,
			type: 'POST'
			dataType: 'json'
			data: contact_form.serialize()
			error: (jqXHR, textStatus, errorThrown) ->
				# @TODO implement ajax error actions
				console.log 'false'
			success: (data, textStatus, jqXHR) ->
				# @TODO implement ajax success actions
				console.log data
				switch data.status
					when 'error' then handleErrors(data)
					when 'success' then toggleEmailSent()
				
		return false
