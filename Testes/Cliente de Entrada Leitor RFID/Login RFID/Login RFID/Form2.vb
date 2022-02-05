Imports MySql.Data.MySqlClient
Imports MySql.Data.MySqlClient.MySqlDataReader



Public Class Form2

    Dim ServerString As String = "Server=localhost;User Id=root;Password=;Database=rfid"
    Dim SQLConnection As MySqlConnection = New MySqlConnection
    Private Sub Label1_Click(sender As Object, e As EventArgs) Handles Label1.Click

    End Sub
    Private Sub Form2_Load(sender As Object, e As EventArgs) Handles MyBase.Load
    End Sub


    Private Sub cmdSearch_Click(sender As Object, e As EventArgs) Handles cmdSearch.Click
        Dim nomea As String
        SQLConnection.ConnectionString = ServerString
        SQLConnection.Open()
        Using cmd As New SqlClient.SqlCommand("SELECT `nome_a` FROM `alunos` WHERE `rfid_a`='" & txtrfid.Text & "'")

            Dim readerObj As SqlClient.SqlDataReader = cmd.ExecuteReader
            SQLConnection.Open()
            While readerObj.Read
                nomea = readerObj("nome_a").ToString
                MsgBox(" " & nomea & " ")
            End While

        End Using
        SQLConnection.Close()



    End Sub

    Private Sub txtrfid_TextChanged(sender As Object, e As EventArgs) Handles txtrfid.TextChanged

    End Sub
End Class

