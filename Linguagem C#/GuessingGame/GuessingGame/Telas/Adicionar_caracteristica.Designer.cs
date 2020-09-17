namespace GuessingGame.Telas {
    partial class Adicionar_caracteristica {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing) {
            if (disposing && (components != null)) {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent() {
            this.label_add_caracteristica = new System.Windows.Forms.Label();
            this.textBox_add_dica = new System.Windows.Forms.TextBox();
            this.btn_ok = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // label_add_caracteristica
            // 
            this.label_add_caracteristica.AutoSize = true;
            this.label_add_caracteristica.Location = new System.Drawing.Point(28, 49);
            this.label_add_caracteristica.Name = "label_add_caracteristica";
            this.label_add_caracteristica.Size = new System.Drawing.Size(542, 17);
            this.label_add_caracteristica.TabIndex = 0;
            this.label_add_caracteristica.Text = "A dog __________ but a shark does not(Fill it with a animal trait, like \"lives in" +
    " water\").";
            // 
            // textBox_add_dica
            // 
            this.textBox_add_dica.Location = new System.Drawing.Point(31, 80);
            this.textBox_add_dica.Name = "textBox_add_dica";
            this.textBox_add_dica.Size = new System.Drawing.Size(539, 22);
            this.textBox_add_dica.TabIndex = 1;
            // 
            // btn_ok
            // 
            this.btn_ok.Location = new System.Drawing.Point(538, 118);
            this.btn_ok.Name = "btn_ok";
            this.btn_ok.Size = new System.Drawing.Size(75, 23);
            this.btn_ok.TabIndex = 2;
            this.btn_ok.Text = "Ok";
            this.btn_ok.UseVisualStyleBackColor = true;
            this.btn_ok.Click += new System.EventHandler(this.btn_ok_Click);
            // 
            // Adicionar_caracteristica
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(639, 153);
            this.Controls.Add(this.btn_ok);
            this.Controls.Add(this.textBox_add_dica);
            this.Controls.Add(this.label_add_caracteristica);
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "Adicionar_caracteristica";
            this.ShowIcon = false;
            this.Text = "Guessing Game";
            this.Load += new System.EventHandler(this.Adicionar_caracteristica_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label_add_caracteristica;
        private System.Windows.Forms.TextBox textBox_add_dica;
        private System.Windows.Forms.Button btn_ok;
    }
}