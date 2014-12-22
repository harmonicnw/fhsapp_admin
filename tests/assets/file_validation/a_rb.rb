require 'mechanize'

class PSATScore
	def initialize(username, password)
		@username = username
		@password = password
		@agent = Mechanize.new
	end

	def get_score
		@agent.user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.58 Safari/537.36'
		login_page = @agent.get('https://quickstart.collegeboard.org/posweb/login.jsp')
		login_form = login_page.form_with(:name => 'qsForm')
		login_form.username = @username
		login_form.password = @password
		login_button = login_form.button_with(:value => 'Sign In')
		agent = @agent.submit(login_form, login_button)

		cr = get_c_r
		wr = get_wr
		mt = get_mt

		cr_score = (48 - (1.25 * cr[:wrong]) - cr[:omitted])
		wr_score = (39 - (1.25 * wr[:wrong]) - wr[:omitted])
		mt_score = (38 - (1.25 * mt[:wrong]) - mt[:omitted])

		puts "Critical Reading:\n\tCorrect: #{cr[:correct]}\n\tWrong: #{cr[:wrong]}\n\tOmitted: #{cr[:omitted]}"
		puts "Writing:\n\tCorrect: #{wr[:correct]}\n\tWrong: #{wr[:wrong]}\n\tOmitted: #{wr[:omitted]}"
		puts "Math:\n\tCorrect: #{mt[:correct]}\n\tWrong: #{mt[:wrong]}\n\tOmitted: #{mt[:omitted]}"

		puts "Critical Reading Raw Score: #{cr_score}"
		puts "Writing Raw Score: #{wr_score}"
		puts "Math Raw Score: #{mt_score}"
	end
private

	def get_c_r
		i = 1
		correct = 0
		wrong = 0
		omitted = 0
		while i < 49
			answer = @agent.get("https://quickstart.collegeboard.org/posweb/questionInfoNewAction.do?testYear=2014&skillCd=CR&questionNbr=#{i}")
			result = answer.parser.css('.skillGroupHeader > p > strong').inner_html
			result.lstrip!
			result.rstrip!
			if result == 'Question you answered correctly'
				correct += 1
			elsif result == 'Question you answered incorrectly'
				wrong += 1
			elsif result == 'Question you answered omitted'
				omitted += 1
			end
			i += 1
		end
		{ correct: correct, wrong: wrong, omitted: omitted }
	end

	def get_mt
		i = 1
		correct = 0
		wrong = 0
		omitted = 0
		while i < 39
			answer = @agent.get("https://quickstart.collegeboard.org/posweb/questionInfoNewAction.do?testYear=2014&skillCd=M&questionNbr=#{i}")
			result = answer.parser.css('.skillGroupHeader > p > strong').inner_html
			result.lstrip!
			result.rstrip!
			if result == 'Question you answered correctly'
				correct += 1
			elsif result == 'Question you answered incorrectly'
				wrong += 1
			elsif result == 'Question you answered omitted'
				omitted += 1
			end
			i += 1
		end
		{ correct: correct, wrong: wrong, omitted: omitted }	
	end

	def get_wr
		i = 1
		correct = 0
		wrong = 0
		omitted = 0
		while i < 40
			answer = @agent.get("https://quickstart.collegeboard.org/posweb/questionInfoNewAction.do?testYear=2014&skillCd=W&questionNbr=#{i}")
			result = answer.parser.css('.skillGroupHeader > p > strong').inner_html
			result.lstrip!
			result.rstrip!
			if result == 'Question you answered correctly'
				correct += 1
			elsif result == 'Question you answered incorrectly'
				wrong += 1
			elsif result == 'Question you answered omitted'
				omitted += 1
			end
			i += 1
		end
		{ correct: correct, wrong: wrong, omitted: omitted }	
	end

end