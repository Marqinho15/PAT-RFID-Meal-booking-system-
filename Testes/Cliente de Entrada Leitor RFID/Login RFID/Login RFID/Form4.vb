Imports MySql.Data.MySqlClient
Public Class Form2
    Private Sub Label1_Click(sender As Object, e As EventArgs) Handles Label1.Click

    End Sub
    Private Sub Form4_Load(sender As Object, e As EventArgs) Handles MyBase.Load
    End Sub


    Private Sub cmdSearch_Click(sender As Object, e As EventArgs) Handles cmdSearch.Click
        Dim nome As String
        Using connObj As New SqlClient.SqlConnection("Server=localhost;UserId=root;database=rfid")
            Using cmdObj As New SqlClient.SqlCommand("select nome_a from alunos where rfid = ' " & TextBox1.Text & "'", connObj)
                connObj.Open()
                Using readerObj As SqlClient.SqlDataReader = cmdObj.ExecuteReader
                    'This will loop through all returned records 
                    While readerObj.Read
                        nome = readerObj("nome_a").ToString
                    End While

                End Using
                connObj.Close()
            End Using
    End Sub
End Class

