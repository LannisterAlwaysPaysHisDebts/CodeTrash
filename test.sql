SELECT UserId,SUM(Money) as num FROM UserIncome GROUP BY UserId ORDER BY num DESC

SELECT User.UserName,SUM(UserIncome.Money) as num FROM User,UserIncome WHERE User.UserId=UserIncome.UserId GROUP BY User.UserName ORDER BY num DESC