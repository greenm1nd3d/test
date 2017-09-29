Answer the following database questions with ANSI standard SQL. 
 
Given the following tables: 
 
Salesperson 
ID,Name,Salary,CommissionRate,Hire,Date 
1,John,100000,6,4/1/2006 
2,Amy,120000,5,5/1/2010 
3,Mark,65000,12,12/25/2008 
4,Pam,25000,25,1/1/2005 
5,Alex,50000,10,2/3/2007 
 
Customer 
ID,Name,City 
1,Red,Boston 
2,Orange,New,York 
3,Yellow,Boston 
4,Green,Austin 
 
Order 
ID,Date,CustomerID,SalesID,Amount 
1,1/1/2014,3,4,100000 
2,2/1/2014,4,5,5000 
3,3/1/2014,1,1,50000 
4,4/1/2014,1,4,25000 
 
1. Given the tables above, write a query that will calculate the total commission of 
each salesperson. 

SELECT o.SalesID, s.Name, SUM(o.Amount * (s.CommissionRate / 100)) AS TotalCommission
FROM `Orders` o
INNER JOIN `Salesperson` s ON o.SalesID = s.ID
GROUP BY o.SalesID
 

2. Name all salespersons who did not sell to company Red. 
==============================================
ANSWER: Alex, Amy, Mark
==============================================

==============================================
PROOF:
==============================================
SELECT s.Name AS SalesPersonName
FROM `Salesperson` s
WHERE s.ID NOT IN (
    SELECT o.SalesID
	FROM `Orders` o
	INNER JOIN `Customer` c ON o.CustomerID = c.ID
    WHERE c.Name = 'Red'
)

SELECT s.Name AS SalesPersonName
FROM `Salesperson` s
WHERE s.ID NOT IN (
    SELECT o.SalesID
	FROM `Orders` o
    WHERE o.CustomerID = (SELECT ID FROM Customer WHERE Name = 'Red')
)

==============================================
NOTES:
Amy and Mark do not have any transactions so if you want to exclude them from the result, you can run this query instead:
==============================================

SELECT s.Name AS SalesPersonName, (SELECT COUNT(ID) FROM Orders WHERE SalesID = s.ID) AS TotalTransactions
FROM `Salesperson` s
WHERE s.ID NOT IN (
    SELECT o.SalesID
	FROM `Orders` o
    WHERE o.CustomerID = (SELECT ID FROM Customer WHERE Name = 'Red')
)
HAVING TotalTransactions > 0

